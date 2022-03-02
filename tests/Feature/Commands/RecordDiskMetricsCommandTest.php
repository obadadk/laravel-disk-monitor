<?php

use Illuminate\Support\Facades\Storage;
use Obadadk\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Obadadk\DiskMonitor\Models\DiskMonitorEntry;
use Obadadk\DiskMonitor\Tests\TestCase;

class RecordDiskMetricsCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
    }

    /** @test */
    public function it_will_recorde_the_file_count_for_a_disk()
    {
        $this
        ->artisan(RecordDiskMetricsCommand::class)
        ->assertExitCode(RecordDiskMetricsCommand::SUCCESS);
        $last = DiskMonitorEntry::last();
        $this->assertEquals(0, $last->file_count);

        Storage::disk('local')->put('test.txt', 'test');
        $this
        ->artisan(RecordDiskMetricsCommand::class)
        ->assertExitCode(RecordDiskMetricsCommand::SUCCESS);
        $last = DiskMonitorEntry::last();
        $this->assertEquals(1, $last->file_count);
    }
}
