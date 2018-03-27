import { Component, OnInit } from '@angular/core';
    
import {AuthService} from '../../services/auth.service';
@Component({
  selector: 'app-wall',
  templateUrl: `wall.component.html`,
  styleUrls : ['wall.component.css'],
})

export class WallComponent implements OnInit {

  showFiller= false;
  constructor(private authService: AuthService ) {}

  ngOnInit() {  }


}