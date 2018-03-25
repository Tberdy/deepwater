import {Member} from './member';
import {Contest} from './contest';

export class Workout {
    id: number;
    member: Member;
    member_id: string;
    opponent: Member;
    opponent_id: string;
    date: string;
    end_date: string;
    location_name: string;
    description: string;
    sport: string;
    contest: Contest;
    contest_id: number;

}

