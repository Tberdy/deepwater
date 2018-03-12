import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

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
        return this.get(this.apiBaseUrl);
    }

    getWorkout(id: number) {
        return this.get(this.apiBaseUrl + '/' + id);
    }
    
    addWorkout(workout: Workout) {
        return this.post(this.apiBaseUrl, JSON.stringify(workout));
    }
    
    putWorkout(workout: Workout) {
        return this.put(this.apiBaseUrl + '/' + workout.id, JSON.stringify(workout));
    }
    
    deleteWorkout(workout: Workout) {
        return this.delete(this.apiBaseUrl + '/' + workout.id);
    }

}
