import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {NgForm} from '@angular/forms';

import {MatSnackBar} from '@angular/material';

import {AuthService} from '../../services/auth.service';

import {ApiResponse} from '../../models/api-response';

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
        ).then((response: ApiResponse) => {
            if (response.success) {
                this.authService.logUser(response.data);
                this.authService.setSession(response.data.token);
                this.snackBar.open('Successful login !', 'OK', {duration: 5000});
                this.router.navigate([this.authService.redirectUrl]);
                this.authService.redirectUrl = '';
            } else {
                this.snackBar.open('Invalid credentials !', 'OK', {duration: 5000});
            }
        }).catch(() => {
            this.snackBar.open('Internal error', 'OK', {duration: 5000});
        });
    }

    ngOnInit() {
    }

    constructor(
        private router: Router,
        private authService: AuthService,
        public snackBar: MatSnackBar) {

    }

}
