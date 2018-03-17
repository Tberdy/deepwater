import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';

import {MemberService} from '../../services/member.service';

import {Member} from '../../models/member';

@Component({
    selector: 'app-friends',
    templateUrl: './friends.component.html',
    styleUrls: ['./friends.component.css']
})
export class FriendsComponent implements OnInit {

    members: Member[];
    selectedMember: Member;
    addingMember = false;
    error: any;
    showNgFor = false;

    constructor(private router: Router, private memberService: MemberService) {}

    ngOnInit() {
        this.getMembers();
    }

    getMembers(): void {
        this.memberService
            .getMembers()
            .then((response: Member[]) => {
                this.members = response;
            })
            .catch(error => this.error = error);
    }

    deleteHero(member: Member, event: any): void {
        event.stopPropagation();
        this.memberService.deleteMember(member)
            .then(res => {
                this.members = this.members.filter(h => h !== member);
                if (this.selectedMember === member) {this.selectedMember = null;}
            })
            .catch(error => this.error = error);
    }

}
