import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {FlexLayoutModule} from '@angular/flex-layout';
import {HttpClientModule} from '@angular/common/http';

import {MatButtonModule} from '@angular/material/button';
import {AgmCoreModule} from '@agm/core';

import {AppRoutingModule} from './app-routing.module';
import {AuthService} from './services/auth.service';

import {AppComponent} from './app.component';
import {HeaderComponent} from './components/header/header.component';
import {FooterComponent} from './components/footer/footer.component';

import {ConfirmDialog} from './dialogs/confirm/confirm.component';

import { FacebookModule } from 'ngx-facebook';



@NgModule({
    declarations: [
        AppComponent,
        HeaderComponent,
        FooterComponent,
        ConfirmDialog,
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        FlexLayoutModule,
        HttpClientModule,
        MatButtonModule,
        
        AgmCoreModule.forRoot({
            apiKey: 'AIzaSyBabLcUh4WekLaJCXvjXSR18gyxsZI36yY'
        }),
        
        FacebookModule.forRoot(),

    ],
    entryComponents: [
        ConfirmDialog,
    ],
    providers: [AuthService],
    bootstrap: [AppComponent]
})
export class AppModule {}
