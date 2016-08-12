<?php namespace Admin\Services;

class LongLat
{
    public function get($request)
    {
        //$address = '63 Chulia Street';
        //$country = 'Singapore';
        //$postal_code = '049154';

        $formattedAddress = str_replace('#', '', str_replace(' ', '+', $request->outlet_add));
        $formattedCountry = str_replace('#', '', str_replace(' ', '+', $request->outlet_country));
        $formattedPostalCode = str_replace('#', '', str_replace(' ', '+', $request->zip));

        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAEyuMyQephg6sm_UQGTwpUAF6kpiv8TLQ&address=' . $formattedAddress . '+' . $formattedCountry . '+' . $formattedPostalCode);
        $output = json_decode($geocodeFromAddr);

        $data['latitude'] = $output->results[0]->geometry->location->lat;
        $data['longitude'] = $output->results[0]->geometry->location->lng;

        return $data;
    }
}
