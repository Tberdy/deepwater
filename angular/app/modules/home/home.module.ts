import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FlexLayoutModule} from '@angular/flex-layout';
import {MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule, MatStepperModule} from '@angular/material';
import {Ng2CarouselamosModule} from 'ng2-carouselamos';
import {HomeRoutingModule} from './home-routing.module';
import {HomeComponent} from '../../components/home/home.component';

@NgModule({
  imports: [
    CommonModule,
    HomeRoutingModule,
    FlexLayoutModule,
    MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule, MatStepperModule,
    Ng2CarouselamosModule
  ],
  declarations: [HomeComponent]
})
export class HomeModule { }
