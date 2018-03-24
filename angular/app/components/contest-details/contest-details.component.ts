import {Component, OnInit, ViewChild, Input} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';
import {ActivatedRoute} from '@angular/router';
import {Location} from '@angular/common';
import {ChangeDetectorRef} from '@angular/core';

import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';
import {MatchFormDialog} from '../../dialogs/match-form/match-form.component';
import {MatchEndFormDialog} from '../../dialogs/match-end-form/match-end-form.component';

import {ContestService} from '../../services/contest.service';
import {WorkoutService} from '../../services/workout.service'
import {MemberService} from '../../services/member.service';

import {Contest} from '../../models/contest';
import {Workout} from '../../models/workout';
import {Member} from '../../models/member';

@Component({
    selector: 'app-contest-details',
    templateUrl: './contest-details.component.html',
    styleUrls: ['./contest-details.component.css']
})
export class ContestDetailsComponent implements OnInit {
    id: number;
    contest: Contest;
    workouts: Workout[];
    members: Member[];

    displayedColumns = ['sport', 'description', 'date', 'end_date', 'location_name', 'opponent', 'actions'];
    dataSource: MatTableDataSource<Workout>;
    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    error: string;
    constructor(private route: ActivatedRoute,
        private memberService: MemberService,
        private contestService: ContestService,
        private workoutService: WorkoutService,
        private location: Location,
        private cdRef: ChangeDetectorRef,
        public dialog: MatDialog) {
        this.dataSource = new MatTableDataSource(this.workouts);
    }

    ngOnInit() {
        this.getContest();
        //this.getWorkouts();
        //this.getContests();
        //this.getMembers();
        this.cdRef.detectChanges();
    }
    ngAfterViewInit() {
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }
    getContest(): void {
        const id = +this.route.snapshot.paramMap.get('id');
        this.contestService.getContest(id).then((contest: Contest) => {
            this.contest = contest;
            this.getWorkouts();
        }).catch(() => {
            this.error = `Pas de compétition avec l'id ${id}`;
            this.cdRef.detectChanges();
        });
    }
    getWorkouts(): void {
        this.workoutService.getMatchsByMember().then((workouts: Workout[]) => {
            this.workouts = workouts;
            this.getMembers();
            this.refreshTable();
        }).catch(() => {

        });
    }
    getMembers(): void {
        this.memberService.getMembers().then((members: Member[]) => {
            this.members = members;
        }).catch(() => {
            console.log('Error while loading members.');
        })
    }

    goBack(): void {
        this.location.back();
    }
    refreshTable() {
        this.dataSource = new MatTableDataSource(this.workouts);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }
    applyFilter(filterValue: string) {
        filterValue = filterValue.trim(); // Remove whitespace
        filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
        this.dataSource.filter = filterValue;
    }
    matchFormDialog(action: string, workout: Workout | null): void {
        let params: any = {
            disableClose: true,
            width: '500px'
        };
        params.data = {
            workout: new Workout,
            members: this.members,
            contest: this.contest,
            action: 'add'
        };
        switch (action) {
            case 'add':
                params.data = {
                    workout: new Workout,
                    members: this.members,
                    contest: this.contest,
                    action: 'add'
                };
                break;
            case 'edit':
                params.data = {
                    workout: workout,
                    members: this.members,
                    contest: this.contest,
                    action: 'edit'
                };
                break;
        }
        let dialogRef = this.dialog.open(MatchFormDialog, params);
        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                switch (action) {
                    case 'add':
                        this.workoutService.addWorkout(result)
                            .then((workout: Workout) => {
                                this.workouts.push(workout);
                                this.refreshTable();
                            }).catch(() => {
                                console.log('Errot while adding match');
                            });
                        break;
                    case 'edit':
                        this.workoutService.putWorkout(result)
                            .then((workout: Workout) => {
                                this.updateWorkoutInTable(workout);
                            }).catch(() => {
                                console.log('Errot while editing match');
                            });
                        break;
                }

            }
        });
    }
    matchEndFormDialog(workout: Workout): void {
        let params: any = {
            disableClose: true,
            width: '500px'
        };
        params.data = {
            workout: new Workout,
            members: this.members,
            action: 'end'
        };
        let dialogRef = this.dialog.open(MatchEndFormDialog, params);
        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                this.workoutService.addWorkout(result)
                    .then((workout: Workout) => {
                        this.workouts.push(workout);
                        this.refreshTable();
                    }).catch(() => {
                        console.log('Error while adding match.');
                    });

            }
        });
    }
    deleteWorkout(workout: Workout) {
        let dialogRef = this.dialog.open(ConfirmDialog, {
            disableClose: true,
            data: {
                title: 'Etes vous sûr de vouloir supprimmer ce match ?',
                content: 'Match : ' + workout.description
            }
        });

        dialogRef.afterClosed().subscribe(result => {
            console.log('The dialog was closed');
            if (result) {
                this.workoutService.deleteWorkout(workout.id).then(() => {
                    this.removeWorkoutFromTable(workout.id);
                }).catch(() => {
                    console.log('Error while deleting match.');
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