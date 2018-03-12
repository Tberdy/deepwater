import {Member} from './member';
import {Sticker} from './sticker';

export class Earning {
    id: number;
    member: Member;
    sticker: Sticker;
    date: string;
}