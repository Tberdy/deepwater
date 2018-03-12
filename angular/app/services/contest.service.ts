import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {RestApi} from '../lib/rest-api';

import {AuthService} from '../services/auth.service';

import {Contest} from '../models/contest';

@Injectable()
export class ContestService extends RestApi {

    constructor(http: HttpClient, authService: AuthService) {
        super(http, authService);
        this.apiBaseUrl = '/api/contests';
    }

    getContests() {
        return this.get(this.apiBaseUrl);
    }

    getContest(id: number) {
        return this.get(this.apiBaseUrl + '/' + id);
    }
    
    addContest(contest: Contest) {
        return this.post(this.apiBaseUrl, JSON.stringify(contest));
    }
    
    putContest(contest: Contest) {
        return this.put(this.apiBaseUrl + '/' + contest.id, JSON.stringify(contest));
    }
    
    deleteContest(contest: Contest) {
        return this.delete(this.apiBaseUrl + '/' + contest.id);
    }

}
