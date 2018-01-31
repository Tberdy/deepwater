import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {FlexLayoutModule} from '@angular/flex-layout';
import {FormsModule} from '@angular/forms';
import {MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule} from '@angular/material';

import {LoginRoutingModule} from './login-routing.module';
import {LoginComponent} from '../../components/login/login.component';

@NgModule({
    imports: [
        CommonModule,
        LoginRoutingModule,
        FlexLayoutModule,
        FormsModule,
        MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule
    ],
    declarations: [LoginComponent]
})
export class LoginModule {}
