import React, { useRef } from "react";
import { Button, Card, Col, Row, Space, Table, Typography } from "antd";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import dayjs from "dayjs";
import { useReactToPrint } from "react-to-print";

const { Text } = Typography;

export default function DetailContract({ contract }) {
  const columns = [
    {
      title: "No Tabung",
      dataIndex: "serial_number",
      key: "serial_number",
    },
    {
      title: "Kategori",
      dataIndex: "category_name",
      key: "category_name",
    },
    {
      title: "Jenis Kontrak",
      dataIndex: "contract_type",
      key: "contract_type",
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
              { name: "Kontrak Peminjaman", route: routes.CONTRACTS_INDEX },
              { name: "Detail Kontrak Peminjaman" },
            ]}
          />
          <Button type="primary" onClick={handlePrint}>
            Print
          </Button>
          <Col span={24} ref={printRef}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Detail Kontrak Peminjaman</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24} className="da-px-12">
                  <Row justify="space-between" align="top">
                    <Space>
                      <Space direction="vertical">
                        <Text strong>Pelanggan:</Text>
                        <Text>Jenis</Text>
                        <Text>Nama</Text>
                        <Text>Nomor Telepon</Text>
                        <Text>Email</Text>
                        <Text>Alamat</Text>
                      </Space>

                      <Space direction="vertical">
                        <Text>&nbsp;</Text>
                        <Text>: {contract.customer.type}</Text>
                        <Text>: {contract.customer.name}</Text>
                        <Text>: {contract.customer.phone}</Text>
                        <Text>: {contract.customer.email}</Text>
                        <Text>: {contract.customer.address}</Text>
                      </Space>
                    </Space>
                    <Space align="start">
                      <Space direction="vertical">
                        <Text>Dari Tanggal</Text>
                        <Text>Sampai Tanggal</Text>
                      </Space>

                      <Space direction="vertical">
                        <Text>
                          : {dayjs(contract.from).format("DD/MM/YYYY")}
                        </Text>
                        <Text>: {dayjs(contract.to).format("DD/MM/YYYY")}</Text>
                      </Space>
                    </Space>
                  </Row>
                </Col>

                <Col span={24}>
                  <Table
                    columns={columns}
                    dataSource={contract.tanks}
                    rowKey="id"
                    pagination={false}
                    bordered={true}
                  />
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
