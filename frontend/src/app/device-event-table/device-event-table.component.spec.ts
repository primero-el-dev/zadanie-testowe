import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DeviceEventTableComponent } from './device-event-table.component';

describe('DeviceEventTableComponent', () => {
  let component: DeviceEventTableComponent;
  let fixture: ComponentFixture<DeviceEventTableComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DeviceEventTableComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(DeviceEventTableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
