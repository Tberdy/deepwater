import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FlexLayoutModule} from '@angular/flex-layout';
import {MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule, MatStepperModule} from '@angular/material';

import { HomeRoutingModule } from './home-routing.module';
import {HomeComponent} from '../../components/home/home.component';

@NgModule({
  imports: [
    CommonModule,
    HomeRoutingModule,
    FlexLayoutModule,
    MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule, MatStepperModule
  ],
  declarations: [HomeComponent]
})
export class HomeModule { }
