import {Member} from './member';
import {Contest} from './contest';

export class Workout {
    id: number;
    member: Member;
    opponent : Member;
    opponent_id : Member;
    date: string;
    end_date: string;
    location_name: string;
    description: string;
    sport: string;
    contest: Contest;
    contest_id : number;
}

