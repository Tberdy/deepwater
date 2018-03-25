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
    winner : Member;
    looser : Member;
    draw: boolean;
    error : string;
    constructor(public dialogRef: MatDialogRef<MatchEndFormDialog>,
        @Inject(MAT_DIALOG_DATA) public data: any) {
        this.opponent = data.opponent;
        this.user = data.user;
        this.draw = false;
    }

    ngOnInit() {
    }
    close(): void {
        this.dialogRef.close();
    }

    submit() {
        
        if (this.draw)
        {
            this.winner = this.user;
            this.looser = this.opponent;
        }
        else if (!this.winner) {
            this.error = 'Aucune séléction !';
            return;
        }
        else{
            if (this.winner == this.user) this.looser = this.opponent;
            else this.looser = this.user;
        }
        let result : any = {
            winner : this.winner,
            looser : this.looser,
            draw : this.draw
        };
        this.dialogRef.close(result);
    }
}
