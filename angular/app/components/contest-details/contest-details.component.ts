import {Component, OnInit, ViewChild, Input} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';
import {ActivatedRoute} from '@angular/router';
import {Location} from '@angular/common';
import {ChangeDetectorRef} from '@angular/core';

import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';
import {MatchFormDialog} from '../../dialogs/match-form/match-form.component';
import {MatchEndFormDialog} from '../../dialogs/match-end-form/match-end-form.component';

import {ContestService} from '../../services/contest.service';
import {LogService} from '../../services/log.service'
import {WorkoutService} from '../../services/workout.service'
import {MemberService} from '../../services/member.service';
import {AuthService} from '../../services/auth.service'

import {Contest} from '../../models/contest';
import {Workout} from '../../models/workout';
import {Member} from '../../models/member';
import {Log} from '../../models/log';

@Component({
    selector: 'app-contest-details',
    templateUrl: './contest-details.component.html',
    styleUrls: ['./contest-details.component.css']
})
export class ContestDetailsComponent implements OnInit {
    id: number;
    contest: Contest;
    workouts: Workout[];
    pastWorkouts: Workout[];
    allWorkouts: Workout[];
    members: Member[];

    displayedColumns = ['sport', 'description', 'date', 'end_date', 'location_name', 'opponent', 'actions'];
    displayedPastColumns = ['sport', 'description', 'end_date', 'location_name', 'opponent'];
    dataMyWorkouts: MatTableDataSource<Workout>;
    dataMyPastWorkouts: MatTableDataSource<Workout>;
    dataSourceOthersWorkouts: MatTableDataSource<Workout>;

    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    @ViewChild(MatPaginator) pastPaginator: MatPaginator;
    @ViewChild(MatSort) pastSort: MatSort;

    error: string;
    constructor(private route: ActivatedRoute,
        private memberService: MemberService,
        private contestService: ContestService,
        private workoutService: WorkoutService,
        private logService: LogService,
        private authService: AuthService,
        private location: Location,
        private cdRef: ChangeDetectorRef,
        public dialog: MatDialog) {
        this.dataMyWorkouts = new MatTableDataSource(this.workouts);
        this.dataMyPastWorkouts = new MatTableDataSource(this.pastWorkouts);
        this.pastWorkouts = new Array < Workout>();
    }

    ngOnInit() {
        this.getContest();
        //this.getWorkouts();
        //this.getContests();
        //this.getMembers();
        this.cdRef.detectChanges();
    }
    ngAfterViewInit() {
        this.dataMyWorkouts.paginator = this.paginator;
        this.dataMyWorkouts.sort = this.sort;
        this.dataMyPastWorkouts.paginator = this.pastPaginator;
        this.dataMyPastWorkouts.sort = this.pastSort;
    }
    getContest(): void {
        const id = +this.route.snapshot.paramMap.get('id');
        this.contestService.getContest(id).then((contest: Contest) => {
            this.contest = contest;
            this.getWorkoutsOfUser();
        }).catch(() => {
            this.error = `Pas de compétition avec l'id ${id}`;
            this.cdRef.detectChanges();
        });
    }
    getWorkoutsOfUser(): void {
        this.workoutService.getMatchsByMember().then((workouts: Workout[]) => {
            this.workouts = workouts;
            this.splitPastWorkouts();
            this.getWorkoutsOfContest();
            this.refreshTable();
        }).catch(() => {
            console.log('Error while loading workouts 1.');
        });
    }
    getWorkoutsOfContest(): void {
        this.workoutService.getMatchsByContest(this.contest.id).then((workouts: Workout[]) => {
            this.allWorkouts = workouts;
            this.getMembers();
            this.refreshTable();
        }).catch(() => {
            console.log('Error while loading workouts 2.');
        });
    }
    getMembers(): void {
        this.memberService.getMembers().then((members: Member[]) => {
            this.members = members;
            this.matchOpponent();
        }).catch(() => {
            console.log('Error while loading members 3.');
        });
    }
    getScores(): void {
        
    }
    splitPastWorkouts(): void {
        this.workouts.forEach((workout: Workout, index) => {
            if (workout.date === workout.end_date) {
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
    matchOpponent(): void {
        this.allWorkouts.forEach((workout: Workout) => {
            this.workouts.forEach((userWorkout: Workout) => {
                
                if (workout.date == userWorkout.date
                    && workout.end_date == userWorkout.end_date
                    && workout.location_name == userWorkout.location_name
                    && workout.description == userWorkout.description
                    && workout.member_id != userWorkout.member_id) {
                    userWorkout.opponent_id = workout.member_id;
                    this.members.forEach((member : Member)=> {
                        if (member.id == userWorkout.opponent_id)
                        {
                            userWorkout.opponent=member;
                        }
                    });
                }
            });
            this.pastWorkouts.forEach((userWorkout: Workout) => {          
                if (workout.date == userWorkout.date
                    && workout.end_date == userWorkout.end_date
                    && workout.location_name == userWorkout.location_name
                    && workout.description == userWorkout.description
                    && workout.member_id != userWorkout.member_id) {
                    userWorkout.opponent_id = workout.member_id;
                    this.members.forEach((member : Member)=> {
                        if (member.id == userWorkout.opponent_id)
                        {
                            userWorkout.opponent=member;
                        }
                    });
                    
                }
            });
        });
    }
    goBack(): void {
        this.location.back();
    }
    refreshTable() {
        this.dataMyWorkouts = new MatTableDataSource(this.workouts);
        this.dataMyWorkouts.paginator = this.paginator;
        this.dataMyWorkouts.sort = this.sort;

        this.dataMyPastWorkouts = new MatTableDataSource(this.pastWorkouts);
        this.dataMyPastWorkouts.paginator = this.pastPaginator;
        this.dataMyPastWorkouts.sort = this.pastSort;
    }
    applyFilter(filterValue: string, val: number) {
        filterValue = filterValue.trim(); // Remove whitespace
        filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
        if (val == 1) this.dataMyWorkouts.filter = filterValue;
        if (val == 2) this.dataMyPastWorkouts.filter = filterValue;
    }
    matchFormDialog(action: string, workout: Workout | null): void {
        let params: any = {
            disableClose: true,
            width: '500px'
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
                result.contest_id = this.contest.id;
                delete result.contest;
                switch (action) {
                    case 'add':
                        this.workoutService.addWorkout(result)
                            .then((workout: Workout) => {
                                this.workouts.push(result);
                                this.refreshTable();
                                this.cdRef.detectChanges();
                            }).catch(() => {
                                console.log('Error while adding match');
                            });
                        break;
                    case 'edit':
                        this.workoutService.putWorkout(result)
                            .then((workout: Workout) => {
                                this.updateWorkoutInTable(result);
                                this.cdRef.detectChanges();
                            }).catch(() => {
                                console.log('Error while editing match');
                            });
                        break;
                }
                this.cdRef.detectChanges();

            }
        });
    }
    matchEndFormDialog(workout: Workout): void {
        let params: any = {
            disableClose: true,
            width: '500px',
            heigth: 'auto'
        };
        
        params.data = {
            opponent: workout.opponent,
            user: this.authService.getUser(),
            action: 'end'
        };
        let dialogRef = this.dialog.open(MatchEndFormDialog, params);
        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                let logWinner = new Log;
                let logLooser = new Log;
                logWinner.workout_id = workout.id;
                logWinner.date = new Date().toUTCString();
                logWinner.location_latitude = 0;
                logWinner.location_logitude = 0;
                logWinner.log_type = '@contest:' + this.contest.id;

                logLooser.workout_id = workout.id;
                logLooser.date = new Date().toUTCString();
                logLooser.location_latitude = 0;
                logLooser.location_logitude = 0;
                logLooser.log_type = '@contest:' + this.contest.id;
                if (result.draw) {
                    logWinner.log_value = 2;
                    logLooser.log_value = 2;
                }
                else {
                    logWinner.log_value = 3;
                    logLooser.log_value = 1;
                }
                this.logService.addSpecialLog(logWinner, result.winner.id, workout.id).then(() => {
                    this.logService.addSpecialLog(logLooser, result.looser.id, workout.id).then(() => {
                        if(result.draw) workout.description += ' - Gagnant : ' + result.winner.email + ', Perdant : ' + result.looser.email;
                        else workout.description += ' - Match nul';
                        workout.date = workout.end_date;
                        this.workoutService.putWorkout(workout).then(() => {
                            this.location.go('/contests/' + this.contest.id);
                        }).catch(() => {
                            console.log('Error while updating workoutService');
                        })
                    }).catch(() => {
                        console.log('Error while adding log of looser');
                    })
                }).catch(() => {
                    console.log('Error while adding logs');
                })

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
