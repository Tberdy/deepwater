import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {Credentials} from '../models/credentials';
import {ApiResponse} from '../models/api-response';

@Injectable()
export class AuthService {
    private user = {
        id: '',
        email: '',
        token: '',
        logged: false
    };

    redirectUrl = '';

    constructor(private http: HttpClient) {
    }

    getUser() {
        return this.user;
    }

    isLogged(): boolean {
        return this.user.logged;
    }

    getHeaders(): HttpHeaders {
        if (this.isLogged()) {
            return new HttpHeaders({'Accept': 'application/json', 'Authorization': 'Bearer ' + this.user.token});
        } else {
            return new HttpHeaders({'Accept': 'application/json'});
        }
    }

    login(email: string, password: string) {
        return this.http.post('/api/members/login', {email: email, password: password}, {headers: this.getHeaders()}).toPromise();
    }

    register(email: string, password: string) {
        return this.http.post('/api/members/register', {email: email, password: password}, {headers: this.getHeaders()}).toPromise();
    }

    logout(): void {
        this.user.token = '';
        this.user.id = '';
        this.user.email = '';
        this.user.logged = false;
    }

    setSession(token: string) {
        localStorage.setItem('token', token);
    }

    loadSession() {
        let token = localStorage.getItem('token');
        if (token) {
            this.user.token = token;
            this.user.logged = true;
            this.http.post('/api/members/login', {}, {headers: this.getHeaders()}).toPromise()
                .then((response: ApiResponse) => {
                    if (response.success) {
                        this.logUser(response.data);
                    }
                });
        }
    }

    logUser(credentials: Credentials): void {
        this.user.token = credentials.token;
        this.user.id = credentials.member.id;
        this.user.email = credentials.member.email;
        this.user.logged = true;
    }

    refreshToken(token: string) {
        this.user.token = token;
    }

}
