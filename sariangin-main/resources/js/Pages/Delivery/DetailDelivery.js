import React, { useRef } from "react";
import { Button, Card, Col, Row, Space, Table, Typography } from "antd";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import dayjs from "dayjs";
import { NoteList } from "@/Components/Delivery/NoteList/NoteList";
import { useReactToPrint } from "react-to-print";

const { Text } = Typography;

export default function DetailDelivery({ delivery }) {
  const columns = [
    {
      title: "Kategori Tabung",
      dataIndex: "name",
      key: "name",
    },
    {
      title: "Jumlah",
      dataIndex: "qty",
      key: "qty",
    },
  ];

  const printRef = useRef();

  const handlePrint = useReactToPrint({
    content: () => printRef.current,
    removeAfterPrint: true,
  });

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Surat Jalan", route: routes.DELIVERIES_INDEX },
              { name: "Detail Surat Jalan" },
            ]}
          />
          <Button type="primary" onClick={handlePrint}>
            Print
          </Button>
          <Col span={24} ref={printRef}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Detail Surat Jalan</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24} className="da-px-12">
                  <Row justify="space-between" align="top">
                    <Space align="start">
                      <Space direction="vertical">
                        <Text>Tanggal</Text>
                        <Text>Jenis Surat</Text>
                        <Text>Driver</Text>
                        <Text>Kendaraan</Text>
                      </Space>

                      <Space direction="vertical">
                        <Text>
                          : {dayjs(delivery.date).format("DD/MM/YYYY")}
                        </Text>
                        <Text>: {delivery.type}</Text>
                        <Text>: {delivery.driver.name}</Text>
                        <Text>
                          : {delivery.vehicle.type} -{" "}
                          {delivery.vehicle.license_plate}
                        </Text>
                      </Space>
                    </Space>

                    <Space>
                      <Space direction="vertical">
                        <Text strong>Detail Pelanggan:</Text>
                        <Text>Jenis</Text>
                        <Text>Nama</Text>
                        <Text>Nomor Telepon</Text>
                        <Text>Email</Text>
                        <Text>Alamat</Text>
                      </Space>

                      <Space direction="vertical">
                        <Text>&nbsp;</Text>
                        <Text>: {delivery.customer.type}</Text>
                        <Text>: {delivery.customer.name}</Text>
                        <Text>: {delivery.customer.phone}</Text>
                        <Text>: {delivery.customer.email}</Text>
                        <Text>: {delivery.customer.address}</Text>
                      </Space>
                    </Space>
                  </Row>
                </Col>

                <Col span={24}>
                  <Table
                    columns={columns}
                    dataSource={delivery.tank_categories}
                    rowKey="id"
                    pagination={false}
                    bordered={true}
                  />
                </Col>

                <Col span={24}>
                  <NoteList notes={delivery.notes} title="Informasi Tambahan" />
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
