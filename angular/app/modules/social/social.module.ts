import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {SocialRoutingModule} from './social-routing.module';

import {MemberService} from '../../services/member.service';

import {ChatComponent} from '../../components/chat/chat.component';
import {WallComponent} from '../../components/wall/wall.component';
import {FriendsComponent} from '../../components/friends/friends.component';

@NgModule({
    imports: [
        CommonModule,
        SocialRoutingModule
    ],
    declarations: [
        ChatComponent,
        WallComponent,
        FriendsComponent,
    ],
    providers: [MemberService],
})
export class SocialModule {}
