import {Component, ViewChild, OnInit} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';
import {MatSlideToggleChange} from '@angular/material/slide-toggle';

import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';


@Component({
    selector: 'app-contact',
    templateUrl: './contact.component.html',
    styleUrls: ['./contact.component.css']
})

export class ContactComponent implements OnInit {
    displayedColumns = ['description', 'serial', 'trusted', 'actions'];


    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;


    ngOnInit() {
    }

}
