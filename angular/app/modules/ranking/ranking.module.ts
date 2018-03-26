import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {RankingRoutingModule} from '../../modules/ranking/ranking-routing.module';

import {RankingComponent} from '../../components/ranking/ranking.component';
@NgModule({
    imports: [
        CommonModule,
        RankingRoutingModule
    ],
    declarations: [
        RankingComponent
    ]
})
export class RankingModule {}
