import {Component, Inject} from '@angular/core';
import {NgForm} from '@angular/forms';

import {MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';
import {MAT_MOMENT_DATE_FORMATS, MomentDateAdapter} from '@angular/material-moment-adapter';
import {DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE} from '@angular/material/core';

import {Workout} from '../../models/workout';

@Component({
    selector: 'workout-form',
    templateUrl: './workout-form.component.html',
    styleUrls: ['./workout-form.component.css'],
    providers: [
        {provide: MAT_DATE_LOCALE, useValue: 'fr'},
        {provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE]},
        {provide: MAT_DATE_FORMATS, useValue: MAT_MOMENT_DATE_FORMATS},
    ],
})
export class WorkoutFormDialog {

    constructor(
        private adapter: DateAdapter<any>,
        public dialogRef: MatDialogRef<WorkoutFormDialog>,
        @Inject(MAT_DIALOG_DATA) public data: any
    ) {
        this.adapter.setLocale('fr');
    }

    close(): void {
        this.dialogRef.close();
    }
    
    submit(form: NgForm) {
        this.dialogRef.close(form.value);
    }

}
