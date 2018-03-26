import {Component, ViewChild, OnInit} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';

import {WorkoutFormDialog} from '../../dialogs/workout-form/workout-form.component';
import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';

import {Workout} from '../../models/workout';

import {WorkoutService} from '../../services/workout.service';

@Component({
    selector: 'app-workouts',
    templateUrl: './workouts.component.html',
    styleUrls: ['./workouts.component.css']
})
export class WorkoutsComponent implements OnInit {
    displayedColumns = ['description', 'sport', 'date', 'end_date', 'location_name', 'actions'];
    displayedPastColumns = ['description', 'sport', 'end_date', 'location_name'];
    dataMyWorkouts: MatTableDataSource<Workout>;
    dataMyPastWorkouts: MatTableDataSource<Workout>;
    workouts: Workout[];
    pastWorkouts: Workout[];

    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    @ViewChild(MatPaginator) pastPaginator: MatPaginator;
    @ViewChild(MatSort) pastSort: MatSort;

    constructor(
        private workoutService: WorkoutService,
        public dialog: MatDialog
    ) {
        this.dataMyWorkouts = new MatTableDataSource(this.workouts);
        this.dataMyPastWorkouts = new MatTableDataSource(this.pastWorkouts);
        this.pastWorkouts = new Array<Workout>();
    }

    ngOnInit() {
        this.workoutService.getWorkouts()
            .then((workouts: Workout[]) => {
                this.workouts = workouts;
                this.splitPastWorkouts();
                this.refreshTable();
            }).catch(() => {
                console.log('Error while loading workouts.');
                this.splitPastWorkouts();
                //this.snackBar.open('Invalid credentials !', 'OK', {duration: 5000});
                //this.snackBar.open('Internal error', 'OK', {duration: 5000});
            });
    }
    splitPastWorkouts(): void {
        this.workouts.forEach((workout: Workout, index) => {
            if (new Date(workout.end_date).getTime() > new Date().getTime()) {
                let newWorkout: Workout = new Workout;
                newWorkout.id = workout.id;
                newWorkout.member = workout.member;
                newWorkout.member_id = workout.member_id;
                newWorkout.opponent = workout.opponent;
                newWorkout.opponent_id = workout.opponent_id;
                newWorkout.date = workout.date;
                newWorkout.end_date = workout.end_date;
                newWorkout.location_name = workout.location_name;
                newWorkout.description = workout.description;
                newWorkout.sport = workout.sport;
                newWorkout.contest = workout.contest;
                newWorkout.contest_id = workout.contest_id;
                this.pastWorkouts.push(newWorkout);
                this.workouts.splice(index, 1);
            }

        });
    }
    ngAfterViewInit() {
        this.dataMyWorkouts.paginator = this.paginator;
        this.dataMyWorkouts.sort = this.sort;
        this.dataMyPastWorkouts.paginator = this.pastPaginator;
        this.dataMyPastWorkouts.sort = this.pastSort;
    }

    applyFilter(filterValue: string, val: number) {
        filterValue = filterValue.trim(); // Remove whitespace
        filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
        if (val == 1) this.dataMyWorkouts.filter = filterValue;
        if (val == 2) this.dataMyPastWorkouts.filter = filterValue;
    }

    formDialog(action: string, workout: Workout | null): void {
        let params: any = {
            disableClose: true,
            width: '500px'
        };

        switch (action) {
            case 'add':
                params.data = {
                    workout: new Workout,
                    action: 'add'
                };
                break;
            case 'edit':
                params.data = {
                    workout: workout,
                    action: 'edit'
                };
                break;
        }

        let dialogRef = this.dialog.open(WorkoutFormDialog, params);

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                switch (action) {
                    case 'add':
                        this.workoutService.addWorkout(result)
                            .then((workout: Workout) => {
                                this.workouts.push(workout);
                                this.refreshTable();
                            }).catch(() => {
                                console.log('Errot while adding workout');
                            });
                        break;
                    case 'edit':
                        this.workoutService.putWorkout(result)
                            .then((workout: Workout) => {
                                this.updateWorkoutInTable(workout);
                            }).catch(() => {
                                console.log('Errot while adding workout');
                            });
                        break;
                }
            }
        });
    }

    refreshTable() {
        this.dataMyWorkouts = new MatTableDataSource(this.workouts);
        this.dataMyWorkouts.paginator = this.paginator;
        this.dataMyWorkouts.sort = this.sort;
        
        this.dataMyPastWorkouts = new MatTableDataSource(this.pastWorkouts);
        this.dataMyPastWorkouts.paginator = this.pastPaginator;
        this.dataMyPastWorkouts.sort = this.pastSort;
    }

    deleteWorkout(workout: Workout) {
        let dialogRef = this.dialog.open(ConfirmDialog, {
            disableClose: true,
            data: {
                title: 'Etes vous sûr de vouloir supprimer ça ?',
                content: 'Séance "' + workout.description + '"'
            }
        });

        dialogRef.afterClosed().subscribe(result => {
            console.log('The dialog was closed');
            if (result) {
                this.workoutService.deleteWorkout(workout.id).then(() => {
                    this.removeWorkoutFromTable(workout.id);
                }).catch(() => {
                    console.log('Error while deleting workout.');
                });
            }
        });
    }

    updateWorkoutInTable(updateWorkout: Workout) {
        let array_index = this.workouts.findIndex(workout => workout.id == updateWorkout.id);
        this.workouts[array_index] = updateWorkout;
        this.refreshTable();
    }

    removeWorkoutFromTable(id: number) {
        let array_index = this.workouts.findIndex(workout => workout.id == id);
        this.workouts.splice(array_index, 1);
        this.refreshTable();

    }

}
