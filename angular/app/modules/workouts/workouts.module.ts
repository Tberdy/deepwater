import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FlexLayoutModule} from '@angular/flex-layout';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

import {MatButtonModule} from '@angular/material/button';
import {MatInputModule} from '@angular/material/input';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatTableModule} from '@angular/material/table';
import {MatPaginatorModule} from '@angular/material/paginator';
import {MatSortModule} from '@angular/material/sort';
import {MatDialogModule} from '@angular/material/dialog';
import {MatDatepickerModule} from '@angular/material/datepicker';

import {WorkoutsRoutingModule} from './workouts-routing.module';

import {WorkoutService} from '../../services/workout.service';

import {WorkoutsComponent} from '../../components/workouts/workouts.component';

@NgModule({
    imports: [
        CommonModule,
        WorkoutsRoutingModule,
        
        FlexLayoutModule,
        FormsModule, ReactiveFormsModule,
        
        MatButtonModule,
        MatInputModule, MatFormFieldModule,
        MatTableModule, MatPaginatorModule, MatSortModule,
        MatDialogModule, MatDatepickerModule,
    ],
    declarations: [
        WorkoutsComponent,
    ],
    providers: [WorkoutService],
})
export class WorkoutsModule {}
