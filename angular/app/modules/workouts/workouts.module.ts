import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FlexLayoutModule} from '@angular/flex-layout';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

import {MatNativeDateModule} from '@angular/material'
import {MatButtonModule} from '@angular/material/button';
import {MatInputModule} from '@angular/material/input';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatTableModule} from '@angular/material/table';
import {MatPaginatorModule} from '@angular/material/paginator';
import {MatSortModule} from '@angular/material/sort';
import {MatDialogModule} from '@angular/material/dialog';
import {MatDatepickerModule} from '@angular/material/datepicker';
import {MatIconModule} from '@angular/material/icon';

import {WorkoutsRoutingModule} from './workouts-routing.module';

import {WorkoutService} from '../../services/workout.service';

import {WorkoutsComponent} from '../../components/workouts/workouts.component';
import {WorkoutFormDialog} from '../../dialogs/workout-form/workout-form.component';
import {DeleteConfirmDialog} from '../../dialogs/delete-confirm/delete-confirm.component';
import {ContestsComponent} from '../../components/contests/contests.component';

@NgModule({
    imports: [
        CommonModule,
        WorkoutsRoutingModule,

        FlexLayoutModule,
        FormsModule, ReactiveFormsModule,

        MatButtonModule, MatIconModule,
        MatInputModule, MatFormFieldModule,
        MatTableModule, MatPaginatorModule, MatSortModule,
        MatDialogModule, MatDatepickerModule, MatNativeDateModule,
    ],
    declarations: [
        WorkoutsComponent,
        WorkoutFormDialog,
        DeleteConfirmDialog,
        ContestsComponent
    ],
    entryComponents: [
        WorkoutFormDialog,
        DeleteConfirmDialog,
    ],
    providers: [WorkoutService],
})
export class WorkoutsModule {}
