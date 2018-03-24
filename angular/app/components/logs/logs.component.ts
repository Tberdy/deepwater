import {Component, ViewChild, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';

import {LogFormDialog} from '../../dialogs/log-form/log-form.component';
import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';

import {Workout} from '../../models/workout';
import {Log} from '../../models/log';

import {WorkoutService} from '../../services/workout.service';
import {LogService} from '../../services/log.service';

@Component({
    selector: 'app-logs',
    templateUrl: './logs.component.html',
    styleUrls: ['./logs.component.css']
})
export class LogsComponent implements OnInit {
    displayedColumns = ['log_type', 'log_value', 'date', 'actions'];
    dataSource: MatTableDataSource<Log>;

    workout_id: number;
    workout: Workout;
    logs: Log[];

    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    constructor(
        private workoutService: WorkoutService,
        private logService: LogService,
        public dialog: MatDialog,
        private route: ActivatedRoute
    ) {
        this.dataSource = new MatTableDataSource(this.logs);
        this.workout = new Workout;
        
        this.workout_id = +this.route.snapshot.paramMap.get('workout_id')
        this.logService.init(this.workout_id);
    }

    ngOnInit() {
        this.workoutService.getWorkout(this.workout_id)
            .then((workout: Workout) => {
                this.workout = workout; 
            }).catch(() => {
                
            });

        this.logService.getLogs()
            .then((logs: Log[]) => {
                this.logs = logs;
                this.refreshTable();
            }).catch(() => {
                //this.snackBar.open('Invalid credentials !', 'OK', {duration: 5000});
                //this.snackBar.open('Internal error', 'OK', {duration: 5000});
            });
    }

    /**
     * Set the paginator and sort after the view init since this component will
     * be able to query its view for the initialized paginator and sort.
     */
    ngAfterViewInit() {
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }

    applyFilter(filterValue: string) {
        filterValue = filterValue.trim(); // Remove whitespace
        filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
        this.dataSource.filter = filterValue;
    }

    formDialog(action: string, log: Log | null): void {
        let params: any = {
            disableClose: true,
            width: '500px'
        };

        switch (action) {
            case 'add':
                params.data = {
                    log: new Log,
                    action: 'add'
                };
                break;
            case 'edit':
                params.data = {
                    log: log,
                    action: 'edit'
                };
                break;
        }

        let dialogRef = this.dialog.open(LogFormDialog, params);

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                switch (action) {
                    case 'add':
                        this.logService.addLog(result)
                            .then((log: Log) => {
                                this.logs.push(log);
                                this.refreshTable();
                            }).catch(() => {
                                console.log('Error while adding log');
                            });
                        break;
                    case 'edit':
                        this.logService.putLog(result)
                            .then((log: Log) => {
                                this.updateLogInTable(log);
                            }).catch(() => {
                                console.log('Error while updating log');
                            });
                        break;
                }
            }
        });
    }

    refreshTable() {
        this.dataSource = new MatTableDataSource(this.logs);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }

    deleteLog(log: Log) {
        let dialogRef = this.dialog.open(ConfirmDialog, {
            disableClose: true,
            data: {
                title: 'Etes vous sûr de vouloir supprimer ça ?',
                content: 'Séance "' + log.log_type + '"'
            }
        });

        dialogRef.afterClosed().subscribe(result => {
            console.log('The dialog was closed');
            if (result) {
                this.logService.deleteLog(log.id).then(() => {
                    this.removeLogFromTable(log.id);
                }).catch(() => {
                    console.log('Error while deleting log.');
                });
            }
        });
    }

    updateLogInTable(updateLog: Log) {
        let array_index = this.logs.findIndex(log => log.id == updateLog.id);
        this.logs[array_index] = updateLog;
        this.refreshTable();
    }

    removeLogFromTable(id: number) {
        let array_index = this.logs.findIndex(log => log.id == id);
        this.logs.splice(array_index, 1);
        this.refreshTable();

    }

}
