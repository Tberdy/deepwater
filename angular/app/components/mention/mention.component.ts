import {Component, ViewChild, OnInit} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';
import {MatSlideToggleChange} from '@angular/material/slide-toggle';

import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';


@Component({
    selector: 'app-mention',
    templateUrl: './mention.component.html',
    styleUrls: ['./mention.component.css']
})

export class MentionComponent implements OnInit {
    displayedColumns = ['description', 'serial', 'trusted', 'actions'];


    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;


    ngOnInit() {
    }

}
