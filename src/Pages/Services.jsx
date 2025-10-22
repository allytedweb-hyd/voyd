import React from 'react'
import ServiceBanner from '../Components/ServicesPage/ServiceBanner'
import ServiceAbout from '../Components/ServicesPage/ServiceAbout'
import ServiceDesign from '../Components/ServicesPage/ServiceDesign'
import ServiceProjects from '../Components/ServicesPage/ServiceProjects'

const Services = () => {
  return (
      <div>
          <ServiceBanner /> 
          <ServiceAbout />
          <ServiceDesign />
          <ServiceProjects/>
    </div>
  )
}

export default Services