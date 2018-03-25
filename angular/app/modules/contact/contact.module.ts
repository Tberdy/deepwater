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
import {MatSlideToggleModule} from '@angular/material/slide-toggle';

import {ContactRoutingModule} from './contact-routing.module';

import {ContactComponent} from '../../components/contact/contact.component';


@NgModule({
    imports: [
        CommonModule,
        ContactRoutingModule,
        
        FlexLayoutModule,
        FormsModule, ReactiveFormsModule,

        MatButtonModule, MatIconModule, MatSlideToggleModule,
        MatInputModule, MatFormFieldModule,
        MatTableModule, MatPaginatorModule, MatSortModule,
        MatDialogModule, MatDatepickerModule, MatNativeDateModule,
        MatCardModule,
    ],
    declarations: [
        ContactComponent,
    ],
    providers: [],
})
export class ContactModule {}
