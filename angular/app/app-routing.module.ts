import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

import {ChatComponent} from './chat/chat.component';

const routes: Routes = [{
    path: '',
    loadChildren: 'app/pages/home/home.module#HomeModule'
},
{
    path: 'login',
    loadChildren: 'app/pages/login/login.module#LoginModule'
},
{
    path: 'my-account',
    loadChildren: 'app/pages/my-account/my-account.module#MyAccountModule'
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
