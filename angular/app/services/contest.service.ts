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
        return this.http.get<Contest[]>(this.apiBaseUrl, {headers: this.getHeaders()}).toPromise();
    }
    
    getContest(id: number) {
        return this.http.get<Contest>(this.apiBaseUrl + '/' + id, {headers: this.getHeaders()}).toPromise();
    }
    
    addContest(workout: object) {
        return this.http.post<Contest>(this.apiBaseUrl, JSON.stringify(workout), {headers: this.getHeaders()}).toPromise();
    }
    
    putContest(workout: Contest) {
        return this.http.put<Contest>(this.apiBaseUrl + '/' + workout.id, JSON.stringify(workout), {headers: this.getHeaders()}).toPromise();
    }
    
    deleteContest(id: number) {
        return this.http.delete(this.apiBaseUrl + '/' + id, {headers: this.getHeaders()}).toPromise();
    }

}
