import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClient } from  '@angular/common/http';

@Component({
  selector: 'app-device-event-table',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './device-event-table.component.html',
  styleUrl: './device-event-table.component.css'
})
export class DeviceEventTableComponent implements OnInit {

  public deviceEvents: any[] = [];
  public selectedEvent: any = {};

  // I could have used injected service, but I decided to use built-in service for simplicity
  constructor(private httpClient: HttpClient) { }

  ngOnInit(): void {
    this.httpClient
      .get('/api/devices/events/')
      .subscribe((data: Object) => {
        this.deviceEvents = (data as any).events;
        this.selectedEvent = this.deviceEvents[0];
      });
  }

  public presentEventDetails(selectedEvent: any): string {
    let content: string = `
      <p>Device id: ${selectedEvent.deviceId || null}</p>
      <p>Event date: ${selectedEvent.eventDate || null}</p>
      <p>Type: ${selectedEvent.type || null}</p>
    `;
    for (let detail in selectedEvent.evtData) {
      content += `<p>${detail}: ${selectedEvent.evtData[detail]}</p>`;
    }

    return content;
  }

  public presentDate(timestamp: number): string {
    let date = new Date(timestamp*1000);
    let year = date.getFullYear();
    let month = this.prefixWithZero(date.getMonth() + 1);
    let day = this.prefixWithZero(date.getDate());
    let hours = this.prefixWithZero(date.getHours());
    let minutes = this.prefixWithZero(date.getMinutes());
    let seconds = this.prefixWithZero(date.getSeconds());

    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
  }

  private prefixWithZero(value: number): string {
    return (value < 10 ? '0' : '') + value;
  }
}
