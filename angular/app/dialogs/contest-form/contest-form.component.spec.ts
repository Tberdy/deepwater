import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import {ContestFormDialog } from './contest-form.component';

describe('ContestFormDialog', () => {
  let component: ContestFormDialog;
  let fixture: ComponentFixture<ContestFormDialog>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ContestFormDialog ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ContestFormDialog);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
