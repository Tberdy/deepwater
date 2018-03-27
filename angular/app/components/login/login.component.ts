import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {NgForm} from '@angular/forms';

import {MatSnackBar} from '@angular/material';

import {AuthService} from '../../services/auth.service';
import {FacebookService, InitParams, LoginOptions, LoginResponse as FbLoginResponse} from 'ngx-facebook';

import {LoginResponse} from '../../models/api-response';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

    hide = true;

    login(form: NgForm) {
        this.authService.login(
            form.value.email,
            form.value.password
        ).then((response: LoginResponse) => {
            this.authService.logUser(response);
            this.authService.setSession(response.token);
            this.snackBar.open('Successful login !', 'OK', {duration: 5000});
            this.router.navigate([this.authService.redirectUrl]);
            this.authService.redirectUrl = '';
        }).catch(() => {
            this.snackBar.open('Invalid credentials !', 'OK', {duration: 5000});
            //this.snackBar.open('Internal error', 'OK', {duration: 5000});
        });
    }

    loginFacebook() {
        const options: LoginOptions = {
            scope: 'email',
            return_scopes: true,
            enable_profile_selector: true
        };
        
        this.fb.login(options)
            .then((response: FbLoginResponse) => console.log(response))
            .catch((error: any) => console.error(error));
    }

    ngOnInit() {
    }

    constructor(
        private router: Router,
        private authService: AuthService,
        private fb: FacebookService,
        public snackBar: MatSnackBar
    ) {
        let initParams: InitParams = {
            appId: '1814790791928691',
            xfbml: true,
            version: 'v2.12'
        };

        fb.init(initParams);
    }

}
