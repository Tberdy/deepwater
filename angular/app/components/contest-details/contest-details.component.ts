import {Component, OnInit, Input} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {Location} from '@angular/common';

import {ContestService} from '../../services/contest.service';

import {Contest} from '../../models/contest';
@Component({
    selector: 'app-contest-details',
    templateUrl: './contest-details.component.html',
    styleUrls: ['./contest-details.component.css']
})
export class ContestDetailsComponent implements OnInit {
    id: number;
    contest: Contest;
    error: string;
    constructor(private route: ActivatedRoute, private contestService: ContestService, private location: Location) {}

    ngOnInit() {
        this.getContest();
    }
    getContest(): void {
        const id = +this.route.snapshot.paramMap.get('id');
        this.contestService.getContest(id).then((contest: Contest) => {
            this.contest = contest;
        }).catch(() => {
            this.error = `Pas de compétition avec l'id ${id}`;
        });
    }
    goBack(): void {
        this.location.back();
    }


}
