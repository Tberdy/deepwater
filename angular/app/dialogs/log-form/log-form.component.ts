import {Component, Inject} from '@angular/core';

import {MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';
import {MAT_MOMENT_DATE_FORMATS, MomentDateAdapter} from '@angular/material-moment-adapter';
import {DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE} from '@angular/material/core';

import {Log} from '../../models/log';

@Component({
    selector: 'log-form',
    templateUrl: './log-form.component.html',
    styleUrls: ['./log-form.component.css'],
    providers: [
        {provide: MAT_DATE_LOCALE, useValue: 'fr'},
        {provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE]},
        {provide: MAT_DATE_FORMATS, useValue: MAT_MOMENT_DATE_FORMATS},
    ],
})
export class LogFormDialog {
    
    log: Log

    constructor(
        private adapter: DateAdapter<any>,
        public dialogRef: MatDialogRef<LogFormDialog>,
        @Inject(MAT_DIALOG_DATA) public data: any
    ) {
        this.adapter.setLocale('fr');
        this.log = data.log;
    }

    close(): void {
        this.dialogRef.close();
    }
    
    submit() {
        this.dialogRef.close(this.log);
    }

}
