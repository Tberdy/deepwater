import {Component, OnInit, Inject} from '@angular/core';

import {MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';

import {Contest} from '../../models/contest';

@Component({
    selector: 'app-contest-form',
    templateUrl: './contest-form.component.html',
    styleUrls: ['./contest-form.component.css']
})
export class ContestFormDialog implements OnInit {

    ngOnInit() {
    }
    contest: Contest
    action: string

    constructor(
        public dialogRef: MatDialogRef<ContestFormDialog>,
        @Inject(MAT_DIALOG_DATA) public data: any
    ) {
        this.contest = data.contest;
        this.action = data.action;
    }

    close(): void {
        this.dialogRef.close();
    }

    submit() {
        this.dialogRef.close(this.contest);
    }

}
