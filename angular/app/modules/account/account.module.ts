import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {FlexLayoutModule} from '@angular/flex-layout';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule, MatStepperModule} from '@angular/material';

import {AccountRoutingModule} from './account-routing.module';

import {LoginComponent} from '../../components/login/login.component';
import {RegisterComponent} from '../../components/register/register.component';
import {MyAccountComponent} from '../../components/my-account/my-account.component';

@NgModule({
    imports: [
        CommonModule,
        AccountRoutingModule,
        FlexLayoutModule,
        FormsModule, ReactiveFormsModule,
        MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule, MatStepperModule
    ],
    declarations: [
        LoginComponent,
        RegisterComponent,
        MyAccountComponent
    ]
})
export class AccountModule {}
