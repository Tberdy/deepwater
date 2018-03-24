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
import {MatCardModule} from '@angular/material/card';
import {MatSelectModule} from '@angular/material/select';

import {AgmCoreModule} from '@agm/core';

import {WorkoutsRoutingModule} from './workouts-routing.module';

import {WorkoutService} from '../../services/workout.service';
import {LogService} from '../../services/log.service';
import {DeviceService} from '../../services/device.service';

import {WorkoutsComponent} from '../../components/workouts/workouts.component';
import {LogsComponent} from '../../components/logs/logs.component';

import {WorkoutFormDialog} from '../../dialogs/workout-form/workout-form.component';

import {LogFormDialog} from '../../dialogs/log-form/log-form.component';

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
        MatCardModule, MatSelectModule,
        
        AgmCoreModule.forRoot({
            apiKey: 'AIzaSyC2_rXFG_O_ciEydc2VYw0514v9iEAjvqY'
        }),
    ],
    declarations: [
        WorkoutsComponent,
        LogsComponent,
        WorkoutFormDialog,
        LogFormDialog,
    ],
    entryComponents: [
        WorkoutFormDialog,
        LogFormDialog,
    ],
    providers: [WorkoutService, LogService, DeviceService],
})
export class WorkoutsModule {}
