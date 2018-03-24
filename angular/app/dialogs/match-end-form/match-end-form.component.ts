import {Component, OnInit} from '@angular/core';
import {MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';

import {Contest} from '../../models/contest';
import {Member} from '../../models/member';
@Component({
    selector: 'app-match-end-form',
    templateUrl: './match-end-form.component.html',
    styleUrls: ['./match-end-form.component.css']
})
export class MatchEndFormDialog implements OnInit {

    constructor(public dialogRef: MatDialogRef<MatchEndFormDialog>) {}

    ngOnInit() {
    }
    close(): void {
        this.dialogRef.close();
    }

    submit() {
        this.dialogRef.close();
    }
}
