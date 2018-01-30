import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {MatSnackBar} from '@angular/material';

import {ApiResponse} from '../models/api-response';
import {Credentials} from '../models/credentials';
import {LoginData} from '../models/login-data';

@Injectable()
export class AuthService {
    private user = {
        id: '',
        email: '',
        token: '',
        logged: false
    };

    getUser() {
        return this.user;
    }

    constructor(private http: HttpClient) {
    }

    login(ld: LoginData) {
        return this.http.post('/api/members/login', {email: ld.email, password: ld.password}, {headers: new HttpHeaders({'Accept': 'application/json', })}).toPromise();
    }

    logUser(credentials: Credentials) {
        this.user.token = credentials.token;
        this.user.id = credentials.member.id;
        this.user.email = credentials.member.email;
        this.user.logged = true;
    }

}
