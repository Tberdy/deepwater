import {Component, ViewChild, OnInit} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';

import {ContestFormDialog} from '../../dialogs/contest-form/contest-form.component';
import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';

import {Contest} from '../../models/contest';
import {ContestService} from '../../services/contest.service';

@Component({
    selector: 'app-contests',
    templateUrl: './contests.component.html',
    styleUrls: ['./contests.component.css']
})
export class ContestsComponent implements OnInit {
    displayedColumns = ['name', 'type', 'description','actions'];
    dataSource: MatTableDataSource<Contest>;

    contests: Contest[];

    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    constructor(private contestService: ContestService,
        public dialog: MatDialog) {
            this.dataSource = new MatTableDataSource(this.contests);
            
        }

    ngOnInit() {
        this.contestService.getContests()
            .then((contests: Contest[]) => {
                this.contests = contests;
                
                this.refreshTable();
            }).catch(() => {
                //this.snackBar.open('Invalid credentials !', 'OK', {duration: 5000});
                //this.snackBar.open('Internal error', 'OK', {duration: 5000});
            });
    }
    refreshTable() {
        this.dataSource = new MatTableDataSource(this.contests);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }
    deleteContest(contest: Contest) {
        let dialogRef = this.dialog.open(ConfirmDialog, {
            disableClose: true,
            data: {
                title: 'Etes vous sûr de vouloir supprimer ça ?',
                content: 'Compétition : "' + contest.name + '"'
            }
        });

        dialogRef.afterClosed().subscribe(result => {
            console.log('The dialog was closed');
            if (result) {
                this.contestService.deleteContest(contest.id).then(() => {
                    this.removeContestFromTable(contest.id);
                }).catch(() => {
                    console.log('Error while deleting contest.');
                });
            }
        });
    }
    formDialog(action: string, contest: Contest | null): void {
        let params: any = {
            disableClose: true,
            width: '500px'
        };

        switch (action) {
            case 'add':
                params.data = {
                    contest: new Contest,
                    action: 'add'
                };
                break;
            case 'edit':
                params.data = {
                    contest: contest,
                    action: 'edit'
                };
                break;
        }

        let dialogRef = this.dialog.open(ContestFormDialog, params);

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                switch (action) {
                    case 'add':
                        this.contestService.addContest(result)
                            .then((contest: Contest) => {
                                this.contests.push(contest);
                                this.refreshTable();
                            }).catch(() => {
                                console.log('Errot while adding contest');
                            });
                        break;
                    case 'edit':
                        this.contestService.putContest(result)
                            .then((contest: Contest) => {
                                this.updateContestInTable(contest);
                            }).catch(() => {
                                console.log('Errot while adding contest');
                            });
                        break;
                }
            }
        });
    }
    updateContestInTable(updateContest: Contest) {
        let array_index = this.contests.findIndex(contest => contest.id == updateContest.id); 
        this.contests[array_index] = updateContest;
        this.refreshTable();
    }

    removeContestFromTable(id: number) {
        let array_index = this.contests.findIndex(contest => contest.id == id);
        this.contests.splice(array_index, 1);
        this.refreshTable();

    }
    applyFilter(filterValue: string) {
        filterValue = filterValue.trim(); // Remove whitespace
        filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
        this.dataSource.filter = filterValue;
    }

}
