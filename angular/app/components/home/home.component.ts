import { Component, OnInit } from '@angular/core';

import {AuthService} from '../../services/auth.service';


@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  items: Array<any> = [];
    constructor(private authService: AuthService) {
    this.items = [
      { name: 'assets/images/thumb1.png', text : 'Organisez des séances avec votre groupe !' },
      { name: 'assets/images/thumb2.png', text : 'Entrainez vous avec vos amis !' },
      { name: 'assets/images/thumb3.png', text : 'Repoussez vos limites avec OhSaySport !' }
    ]
  }



  ngOnInit() {
  }

}
