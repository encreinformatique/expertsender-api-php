<?php

namespace ExpertSenderFr\ExpertSenderApi\Tests\Services;

use ExpertSenderFr\ExpertSenderApi\ApiResponse;
use ExpertSenderFr\ExpertSenderApi\Model\SignalSpamReport;
use ExpertSenderFr\ExpertSenderApi\Test\FakeApiRequest;
use ExpertSenderFr\ExpertSenderApi\Test\TestClient;
use PHPUnit\Framework\TestCase;

class SignalSpamStatisticsTest extends TestCase
{
    /**
     * @test
     */
    public function canQuery(): void
    {
        $responseBody = <<<EOF
<ApiResponse xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
   <Data>
      <SignalSpamStatistics>
         <SignalSpamStatistic>
            <IsSummaryRow>true</IsSummaryRow>
            <Date xsi:nil="true"/>
            <Delivered>0</Delivered>
            <Complaints>1332</Complaints>
            <ComplaintRate>0.00</ComplaintRate>
            <Spamtraps>1110</Spamtraps>
         </SignalSpamStatistic>
         <SignalSpamStatistic>
            <Date>2015-10-18</Date>
            <Delivered>0</Delivered>
            <Complaints>0</Complaints>
            <ComplaintRate>0.00</ComplaintRate>
            <Spamtraps>0</Spamtraps>
         </SignalSpamStatistic>
         <SignalSpamStatistic>
            <Date>2015-10-17</Date>
            <Delivered>0</Delivered>
            <Complaints>0</Complaints>
            <ComplaintRate>0.00</ComplaintRate>
            <Spamtraps>0</Spamtraps>
         </SignalSpamStatistic>
         <SignalSpamStatistic>
            <Date>2015-10-16</Date>
            <Delivered>0</Delivered>
            <Complaints>0</Complaints>
            <ComplaintRate>0.00</ComplaintRate>
            <Spamtraps>0</Spamtraps>
         </SignalSpamStatistic>
         <SignalSpamStatistic>
            <Date>2015-10-15</Date>
            <Delivered>0</Delivered>
            <Complaints>0</Complaints>
            <ComplaintRate>0.00</ComplaintRate>
            <Spamtraps>0</Spamtraps>
         </SignalSpamStatistic>
         <SignalSpamStatistic>
            <Date>2015-10-14</Date>
            <Delivered>0</Delivered>
            <Complaints>888</Complaints>
            <ComplaintRate>0.00</ComplaintRate>
            <Spamtraps>333</Spamtraps>
         </SignalSpamStatistic>
         <SignalSpamStatistic>
            <Date>2015-10-13</Date>
            <Delivered>0</Delivered>
            <Complaints>333</Complaints>
            <ComplaintRate>0.00</ComplaintRate>
            <Spamtraps>222</Spamtraps>
         </SignalSpamStatistic>
         <SignalSpamStatistic>
            <Date>2015-10-12</Date>
            <Delivered>0</Delivered>
            <Complaints>111</Complaints>
            <ComplaintRate>0.00</ComplaintRate>
            <Spamtraps>555</Spamtraps>
         </SignalSpamStatistic>
      </SignalSpamStatistics>
   </Data>
</ApiResponse>
EOF;
        $response = new ApiResponse($responseBody, 200, []);
        $request = new FakeApiRequest();
        $request->setResponse($response);

        $client = new TestClient('<YOUR_API_KEY_HERE>', 'https://api2.esv2.com');
        $client->setNextRequest($request);
        $service = $client->signalSpamStatistics();

        $res = $service->get(null, null, ['grouping' => 'Provider']);

        self::assertIsArray($res);
        self::assertCount(8, $res);
        self::assertInstanceOf(SignalSpamReport::class, $res[0]);
        self::assertTrue($res[0]->isSummaryRow);
        self::assertEquals(0, $res[0]->delivered);
        self::assertEquals(1332, $res[0]->complaints);
        self::assertEquals(0.00, $res[0]->complaintRate);
        self::assertEquals(1110, $res[0]->spamTraps);
    }
}
