import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FlexLayoutModule} from '@angular/flex-layout';
import {MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule, MatStepperModule} from '@angular/material';
import {WallRoutingModule} from './wall-routing.module';
import {WallComponent} from '../../components/wall/wall.component';

@NgModule({
  imports: [
    CommonModule,
    WallRoutingModule,
    FlexLayoutModule,
    MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule, MatStepperModule,
  ],
  declarations: [WallComponent]
})
export class WallModule { }
