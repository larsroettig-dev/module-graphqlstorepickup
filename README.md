[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/larsroettig/module-graphqlstorepickup/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/larsroettig/module-graphqlstorepickup/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/larsroettig/module-graphqlstorepickup/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/larsroettig/module-graphqlstorepickup/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/larsroettig/module-graphqlstorepickup/badges/build.png?b=master)](https://scrutinizer-ci.com/g/larsroettig/module-graphqlstorepickup/build-status/master)

# Magento Module LarsRoettig_GraphQLStorePickup

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [How to use it](#markdown-header-how-to-use-it)

## Main Functionalities

I will show how you can build your GraphQL for Magento 2.3 and extend them with a filter logic.
Our use case is a Pickup from Store endpoint what our frontend team needs to create an interactive map.

**In the story, we have the following acceptance criteria.**

As a frontend developer, I need  Endpoint to search for the next Pickup Store in a Postcode Area.
Use a setup script initial import
Allow search for Postcode or Name.
API will return the  following  attributes for a Pickup Store

<table class="table-auto w-full">
  <thead>
    <tr class="border bg-gray-100">
      <th class="px-4 py-2">Arrribute Name</th>
      <th class="px-4 py-2">GraphQL field</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     <td class="border px-4 py-2">Name</td>
     <td class="border px-4 py-2">name</td>
    </tr>
    <tr>
      <td class="border px-4 py-2">Postcode</td>
      <td class="border px-4 py-2">postcode</td>
    </tr>
    <tr>
      <td class="border px-4 py-2">Street</td>
      <td class="border px-4 py-2">street</td>
    </tr>
    <tr>
      <td class="border px-4 py-2">Street Number</td>
      <td class="border px-4 py-2">street_num</td>
    </tr>
    <tr>
      <td class="border px-4 py-2">City</td>
      <td class="border px-4 py-2">city</td>
    </tr>
    <tr>
      <td class="border px-4 py-2">Longitude</td>
      <td class="border px-4 py-2">longitude</td>
    </tr>
      <tr>
      <td class="border px-4 py-2">Latitude</td>
      <td class="border px-4 py-2">latitude</td>
    </tr>
  </tbody>
</table>


##### :exclamation: The Code is not for a **production server** it is only **proof of concept** imeplementation :exclamation: 

### Features
* Create new Table with Declarative Schema
* Use Data Patch to import Sample Data
* Implement own GraphQL Endpoint with Filter Query

## Tested on Version
* Magento 2.3.3

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in to `app/code/LarsRoettig/GraphQLStorePickup`
 - Enable the module by running `php bin/magento module:enable LarsRoettig_GraphQLStorePickup`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Install the module composer by running `composer require larsroettig/module-graphqlstorepickup`
 - enable the module by running `php bin/magento module:enable LarsRoettig_GraphQLStorePickup`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

## How to use it 

## Possibly Query (https://your_domain.test/graphql)

![GraphQL_Playground](https://github.com/larsroettig/module-graphqlstorepickup/blob/master/doc/GraphQL_Playground.png)

**Simple Query without an filter:**
```graphql
{
  pickUpStores {
    total_count
      items {
        name
        street
        street_num
        postcode
      }
  }
}
```

**Query with an filter:**
```graphql
{
  pickUpStores(
    filter: { name: { like: "Brick and Mortar 1%" } }
    pageSize: 2
    currentPage: 1
  ) {
    total_count
    items {
      name
      street
      postcode
    }
  }
}
```
