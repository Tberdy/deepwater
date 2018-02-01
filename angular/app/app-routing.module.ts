import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

import {AuthGuard} from './services/auth-guard.service';
import {AuthService} from './services/auth.service';

import {ChatComponent} from './chat/chat.component';

const routes: Routes = [{
    path: '',
    loadChildren: 'app/modules/home/home.module#HomeModule'
},
{
    path: 'account',
    loadChildren: 'app/modules/account/account.module#AccountModule'
},
{
    path: 'chat',
    canActivate: [AuthGuard],
    component: ChatComponent,
}];



@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule],
    providers: [AuthGuard, AuthService]
})
export class AppRoutingModule {}
