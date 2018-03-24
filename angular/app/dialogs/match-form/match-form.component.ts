import {Component, OnInit, Inject} from '@angular/core';

import {MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';
import {MAT_MOMENT_DATE_FORMATS, MomentDateAdapter} from '@angular/material-moment-adapter';
import {DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE} from '@angular/material/core';

import {Workout} from '../../models/workout';
import {Contest} from '../../models/contest';
import {Member} from '../../models/member';

@Component({
    selector: 'app-match-form',
    templateUrl: './match-form.component.html',
    styleUrls: ['./match-form.component.css'],
    providers: [
        {provide: MAT_DATE_LOCALE, useValue: 'fr'},
        {provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE]},
        {provide: MAT_DATE_FORMATS, useValue: MAT_MOMENT_DATE_FORMATS},
    ]
})
export class MatchFormDialog implements OnInit {

    workout: Workout
    contest : Contest;
    members: Member[];
    
    constructor(
        private adapter: DateAdapter<any>,
        public dialogRef: MatDialogRef<MatchFormDialog>,
        @Inject(MAT_DIALOG_DATA) public data: any
    ) {
        this.adapter.setLocale('fr');
        this.workout = data.workout;
        this.workout.contest = data.contest;
        this.members = data.members;
    }
    close(): void {
        this.dialogRef.close();
    }
    
    submit() {
        this.dialogRef.close(this.workout);
    }
    ngOnInit() {
        
    }
    

}
