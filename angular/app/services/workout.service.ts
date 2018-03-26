import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import { Observable } from 'rxjs/Observable';
import { of } from 'rxjs/observable/of';
import { catchError, map, tap } from 'rxjs/operators';

import {RestApi} from '../lib/rest-api';

import {AuthService} from '../services/auth.service';

import {Workout} from '../models/workout';

@Injectable()
export class WorkoutService extends RestApi {

    constructor(http: HttpClient, authService: AuthService) {
        super(http, authService);
        this.apiBaseUrl = '/api/members/' + this.authService.getUser().id + '/workouts';
    }

    getWorkouts() {
        return this.http.get<Workout[]>(this.apiBaseUrl, {headers: this.getHeaders()}).toPromise();
    }


    getWorkout(id: number) {
        return this.http.get<Workout>(this.apiBaseUrl + '/' + id, {headers: this.getHeaders()}).toPromise();
    }
    
    addWorkout(workout: object) {
        return this.http.post<Workout>(this.apiBaseUrl, JSON.stringify(workout), {headers: this.getHeaders()}).toPromise();
    }
    
    putWorkout(workout: Workout) {
        return this.http.put<Workout>(this.apiBaseUrl + '/' + workout.id, JSON.stringify(workout), {headers: this.getHeaders()}).toPromise();
    }
    
    deleteWorkout(id: number) {
        return this.http.delete(this.apiBaseUrl + '/' + id, {headers: this.getHeaders()}).toPromise();
    }
    
    getMatchsByMember() {
        return this.http.get<Workout[]>('/api/members/' + this.authService.getUser().id + '/matchs', {headers: this.getHeaders()}).toPromise();
    }
    
    getMatchsByContest(contest_id: number) {
        return this.http.get<Workout[]>('/api/contests/' + contest_id + '/matchs', {headers: this.getHeaders()}).toPromise();
    }
    getPastWorkouts(member_id: string)
    {
        
    }
    getMissedWorkouts(member_id: string)
    {
        
    }
    updateWorkout()
    {
        
    }
    

}
