import {Component, ViewChild, OnInit} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';

import {Contest} from '../../models/contest';
import {ContestService} from '../../services/contest.service';

@Component({
  selector: 'app-contests',
  templateUrl: './contests.component.html',
  styleUrls: ['./contests.component.css']
})
export class ContestsComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
