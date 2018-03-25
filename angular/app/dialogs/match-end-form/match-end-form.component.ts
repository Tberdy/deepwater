import {Component, OnInit, Inject} from '@angular/core';
import {MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';

import {Member} from '../../models/member';
@Component({
    selector: 'app-match-end-form',
    templateUrl: './match-end-form.component.html',
    styleUrls: ['./match-end-form.component.css']
})
export class MatchEndFormDialog implements OnInit {

    opponent: Member;
    user: Member;
    users: Member[];
    winner : Member;
    looser : Member;
    draw: boolean;

    constructor(public dialogRef: MatDialogRef<MatchEndFormDialog>,
        @Inject(MAT_DIALOG_DATA) public data: any) {
        this.opponent = data.opponent;
        this.user = data.user;
        this.users = [this.user, this.opponent];
        this.draw = false;
    }

    ngOnInit() {
    }
    close(): void {
        this.dialogRef.close();
    }

    submit() {
        this.dialogRef.close();
    }
}
