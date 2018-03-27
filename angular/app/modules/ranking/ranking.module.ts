import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {MatNativeDateModule} from '@angular/material';
import {MatSidenavModule} from '@angular/material/sidenav';
import {MatButtonModule} from '@angular/material/button';
import {MatInputModule} from '@angular/material/input';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatTableModule} from '@angular/material/table';
import {MatPaginatorModule} from '@angular/material/paginator';
import {MatSortModule} from '@angular/material/sort';
import {MatDialogModule} from '@angular/material/dialog';
import {MatIconModule} from '@angular/material/icon';
import {MatCardModule} from '@angular/material/card';
import {MatSelectModule} from '@angular/material/select';

import {RankingRoutingModule} from '../../modules/ranking/ranking-routing.module';

import {RankingComponent} from '../../components/ranking/ranking.component';

import {WorkoutService} from '../../services/workout.service';
import {LogService} from '../../services/log.service';
import {ContestService} from '../../services/contest.service';
import {MemberService} from '../../services/member.service';


@NgModule({
    imports: [
        CommonModule,
        RankingRoutingModule,
        MatButtonModule, MatIconModule,
        MatInputModule, MatFormFieldModule,
        MatTableModule, MatPaginatorModule, MatSortModule,
        MatDialogModule, MatNativeDateModule, MatCardModule,
        MatSelectModule, MatSidenavModule,
    ],
    declarations: [
        RankingComponent
    ],
    providers: [WorkoutService, LogService, ContestService, MemberService]
})
export class RankingModule {}
