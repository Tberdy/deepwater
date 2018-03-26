import {Component, OnInit, Input, ViewChild} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';

import {MemberService} from '../../services/member.service';
import {AuthService} from '../../services/auth.service'

import {Score} from '../../models/score';
import {Member} from '../../models/member';

@Component({
    selector: 'app-ranking',
    templateUrl: './ranking.component.html',
    styleUrls: ['./ranking.component.css']
})
export class RankingComponent implements OnInit {
    members: Member[];
    scores: Score[];
    displayedScoreColumns = ['member', 'score', 'order'];
    dataScores: MatTableDataSource<Score>;

    @ViewChild(MatPaginator) scorePaginator: MatPaginator;
    @ViewChild(MatSort) scoreSort: MatSort;

    constructor(private memberService: MemberService,
        private authService: AuthService,
        public dialog: MatDialog) {
        this.dataScores = new MatTableDataSource(this.scores);
        this.scores = new Array<Score>();
    }

    ngOnInit() {
    }
    ngAfterViewInit() {
        this.dataScores.paginator = this.scorePaginator;
        this.dataScores.sort = this.scoreSort;
        
    }
    
    getMembers(): void {
        this.memberService.getMembers().then((members: Member[]) => {
            this.members = members;
        }).catch(() => {
            console.log('Error while loading members 3.');
        });
    }
    getScores(): void {
        this.memberService.getPerformances().then((result: any) => {
            let dic: {[index: string]: any;} = result;
            for (let key in dic) {
                let value = dic[key];
                this.addScoreToUser(key, value);

            }
            this.sortScores();
            this.refreshTable();
        })
    }
    sortScores():void
    {
        this.scores.sort((n1, n2) => n2.score - n1.score);
        this.scores.forEach((value,index)=> {
            value.index=index+1;
        })
    }
    addScoreToUser(user_id: string, score: number) :void {

        this.members.forEach((value) => {
            if (value.id === user_id) {
                let scoreAssociation: Score = new Score();
                scoreAssociation.member = value;
                scoreAssociation.score = score;
                this.scores.push(scoreAssociation);
            }
        })


    }
    refreshTable() {
        this.dataScores = new MatTableDataSource(this.scores);
        this.dataScores.paginator = this.scorePaginator;
        this.dataScores.sort = this.scoreSort;
    }
    applyFilter(filterValue: string) {
        filterValue = filterValue.trim(); // Remove whitespace
        filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
        this.dataScores.filter = filterValue;
    }
    

}
