import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FlexLayoutModule} from '@angular/flex-layout';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

import {MatNativeDateModule} from '@angular/material';
import {MatSidenavModule} from '@angular/material/sidenav';
import {MatRadioModule} from '@angular/material/radio';
import {MatSlideToggleModule} from '@angular/material/slide-toggle';
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

import {ContestsRoutingModule} from './contests-routing.module';

import {WorkoutService} from '../../services/workout.service';
import {LogService} from '../../services/log.service';
import {ContestService} from '../../services/contest.service';
import {MemberService} from '../../services/member.service';

import {ContestsComponent} from '../../components/contests/contests.component';
import {ContestDetailsComponent} from '../../components/contest-details/contest-details.component';

import {ContestFormDialog} from '../../dialogs/contest-form/contest-form.component';
import {MatchFormDialog} from '../../dialogs/match-form/match-form.component';
import {MatchEndFormDialog} from '../../dialogs/match-end-form/match-end-form.component';

@NgModule({
    imports: [
        CommonModule,
        ContestsRoutingModule,

        FlexLayoutModule,
        FormsModule, ReactiveFormsModule,

        MatButtonModule, MatIconModule,
        MatInputModule, MatFormFieldModule,
        MatTableModule, MatPaginatorModule, MatSortModule,
        MatDialogModule, MatDatepickerModule, MatNativeDateModule,
        MatSlideToggleModule, MatCardModule, MatSelectModule, MatRadioModule, MatSidenavModule,

        AgmCoreModule.forRoot({
            apiKey: 'AIzaSyC2_rXFG_O_ciEydc2VYw0514v9iEAjvqY'
        }),
    ],
    declarations: [
        ContestsComponent,
        ContestDetailsComponent,
        ContestFormDialog,
        MatchFormDialog,
        MatchEndFormDialog
    ],
    entryComponents: [
        ContestFormDialog,
        MatchFormDialog,
        MatchEndFormDialog
    ],
    providers: [WorkoutService, LogService, ContestService, MemberService],
})
export class ContestsModule {}
