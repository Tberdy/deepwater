import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';

import {MatSnackBar} from '@angular/material';

import {AuthService} from '../../services/auth.service';

import {LoginResponse} from '../../models/api-response';

@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
    emailFormGroup: FormGroup;
    passwordFormGroup: FormGroup;

    constructor(
        private _formBuilder: FormBuilder,
        private router: Router,
        private authService: AuthService,
        public snackBar: MatSnackBar) {

    }

    ngOnInit() {
        this.emailFormGroup = this._formBuilder.group({
            email: ['', [Validators.required, Validators.email]]
        });
        this.passwordFormGroup = this._formBuilder.group({
            password: ['', [Validators.required, Validators.min(6)]]
        });
    }

    register() {
        this.authService.register(
            this.emailFormGroup.value.email,
            this.passwordFormGroup.value.password
        ).then((response: LoginResponse) => {
            this.authService.logUser(response);
            this.snackBar.open('Successful registration !', 'OK', {duration: 5000});
            this.router.navigate(['']);
        }).catch(() => {
            this.snackBar.open('Internal error', 'OK', {duration: 5000});
        });
    }

}
