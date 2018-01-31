import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

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
    component: ChatComponent,
}];



@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {}
